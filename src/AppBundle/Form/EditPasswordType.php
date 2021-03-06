<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditPasswordType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
		->add('password', RepeatedType::class, array(
                'invalid_message' => "Las contraseñas no coinciden",    
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Contraseña',
							'required' => 'required',
							'attr' => array(
								'class' => 'form-password form-control'
							)),
                'second_options' => array('label' => 'Repetir contraseña',
							'required' => 'required',
							'attr' => array(
								'class' => 'form-password form-control'
							))
		))
		->add('Cambiar', SubmitType::class, array(
			"attr" => array(
				"class" => "form-submit btn btn-success"
			)
		))
	;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_user';
    }


}
