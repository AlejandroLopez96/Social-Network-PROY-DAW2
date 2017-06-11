<?php

namespace AppBundle\Twig;

class LongTimeExtension extends \Twig_Extension {
	
	public function getFilters() {
		return array(
			new \Twig_SimpleFilter('long_time', array($this, 'LongTimeFilter')),
		);
	}
	
	public function LongTimeFilter($date) {
		if ($date == null) {
			return "Sin fecha";
		}

		$start_date = $date;
		//Sacamos la diferencia entre la start_date y la fechad de ahora que es date y esto se hace en formato DateTime
		$since_start = $start_date->diff(new \DateTime(date("Y-m-d") . " " . date("H:i:s")));

		//Con esto calculamos cuantos segundos, mins, horas, dias, meses y años que han pasado
		if ($since_start->y == 0) {
			if ($since_start->m == 0) {
				if ($since_start->d == 0) {
					if ($since_start->h == 0) {
						if ($since_start->i == 0) {
							if ($since_start->s == 0) {
								$result = $since_start->s . ' segundos';
							} else {
								if ($since_start->s == 1) {
									$result = $since_start->s . ' segundo';
								} else {
									$result = $since_start->s . ' segundos';
								}
							}
						} else {
							if ($since_start->i == 1) {
								$result = $since_start->i . ' minuto';
							} else {
								$result = $since_start->i . ' minutos';
							}
						}
					} else {
						if ($since_start->h == 1) {
							$result = $since_start->h . ' hora';
						} else {
							$result = $since_start->h . ' horas';
						}
					}
				} else {
					if ($since_start->d == 1) {
						$result = $since_start->d . ' día';
					} else {
						$result = $since_start->d . ' días';
					}
				}
			} else {
				if ($since_start->m == 1) {
					$result = $since_start->m . ' mes';
				} else {
					$result = $since_start->m . ' meses';
				}
			}
		} else {
			if ($since_start->y == 1) {
				$result = $since_start->y . ' año';
			} else {
				$result = $since_start->y . ' años';
			}
		}

		return "Hace " . $result;
	}
	
	public function getName(){
		return 'long_time_extension';
	}

}