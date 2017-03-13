<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PrivateMessageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$user = $options['empty_data'];
        $builder
		->add('receiver', EntityType::class, array(
			'class' => 'BackendBundle:User',//Va a utilizar la clase de User para realizar la query
			'query_builder' => function($er) use($user){//Va a recibir un funcion que va a recibir el repositorio y va a usar el usuario que le va a llegar al formulario
				return $er->getFollowingUsers($user);
			},
			'choice_label' => function($user){//Aqui le indicamos como queremos que muestre los datos en el select
				return $user->getName()." ".$user->getSurname()." - ".$user->getNick();
			},
			'label' => 'Para: ',
			'attr' => array('class' => 'form-control')
		))
		->add('message', TextareaType::class, array(
			'label'=> 'Mensaje',
			'required' => true,
			'attr' => array(
				'class' => 'form-control'
			)
		))
		->add('image', FileType::class, array(
			'label'=> 'Imagen',
			'required' => false,
			'data_class' => null,//El atributa data_class se encarga de decir a que clase pertenece esto pero normalmente se utiliza para mostras que ese campo es independiente y nos va a permitir manipular totalmente la imagen que subamos
			'attr' => array(
				'class' => 'form-control'
			)
		))
		->add('file', FileType::class, array(
			'label'=> 'Archivo',
			'required' => false,
			'data_class' => null,//El atributa data_class se encarga de decir a que clase pertenece esto pero normalmente se utiliza para mostras que ese campo es independiente y nos va a permitir manipular totalmente la imagen que subamos
			'attr' => array(
				'class' => 'form-control'
			)
		))
		->add('Enviar', SubmitType::class, array(
			"attr" => array(
				"class" => "btn btn-success"
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
            'data_class' => 'BackendBundle\Entity\PrivateMessage'
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
