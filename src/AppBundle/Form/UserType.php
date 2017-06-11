<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
		->add('name', TextType::class, array(
			'label' => 'Nombre',
			'required' => 'required',
			'attr' => array(
				'class' => 'form-name form-control'
			)
		))
		->add('surname', TextType::class, array(
			'label'=> 'Apellidos',
			'required' => 'required',
			'attr' => array(
				'class' => 'form-surname form-control'
			)
		))
		->add('nick', TextType::class, array(
			'label'=> 'Nick',
			'required' => 'required',
			'attr' => array(
				'class' => 'form-nick form-control'
			)
		)) 
		->add('email', EmailType::class, array(
			'label'=> 'Correo electrónico',
			'required' => 'required',
			'attr' => array(
				'class' => 'form-email form-control'
			)
		))
		->add('bio', TextareaType::class, array(
			'label'=> 'Biografía',
			'required' => false,
			'attr' => array(
				'class' => 'form-bio form-control'
			)
		))
		->add('image', FileType::class, array(
			'label'=> 'Foto',
			'required' => false,
			'data_class' => null,//El atributa data_class se encarga de decir a que clase pertenece esto pero normalmente se utiliza para mostras que ese campo es independiente y nos va a permitir manipular totalmente la imagen que subamos
			'attr' => array(
				'class' => 'form-image form-control'
			)
		))
		->add('Guardar', SubmitType::class, array(
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
