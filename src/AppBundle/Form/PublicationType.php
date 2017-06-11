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

class PublicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
		->add('text', TextareaType::class, array(
			'label'=> 'Meow',
			'required' => true,
			'attr' => array(
				'class' => 'form-control',
				'placeholder' => '¿Que te cuentas?'
			)
		))
		->add('image', FileType::class, array(
			'label'=> ' ',
                        'label_attr' => array (
                                'class' => 'glyphicon glyphicon-camera image'
                        ),
			'required' => false,
			'data_class' => null,//El atributa data_class se encarga de decir a que clase pertenece esto pero normalmente se utiliza para mostras que ese campo es independiente y nos va a permitir manipular totalmente la imagen que subamos
			'attr' => array(
				'class' => 'input-image'
			)
		))
		->add('document', FileType::class, array(
			'label'=> ' ',
                        'label_attr' => array (
                                'class' => 'glyphicon glyphicon-paperclip file'
                        ),
			'required' => false,
			'data_class' => null,//El atributa data_class se encarga de decir a que clase pertenece esto pero normalmente se utiliza para mostras que ese campo es independiente y nos va a permitir manipular totalmente la imagen que subamos
			'attr' => array(
				'class' => 'input-file'
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
            'data_class' => 'BackendBundle\Entity\Publication'
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
