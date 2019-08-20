<?php

namespace App\Form;

use App\Entity\Todolist;
use App\Repository\AuthorsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TodolistType extends AbstractType
{
    private $authorRepository;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->authorRepository = $options["authorRepository"];
        $builder
            ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('details', TextType::class, array('label' => 'Détails'))
            ->add('id_author', ChoiceType::class, [
                "choices" => $this->getChoices(), 'label' => 'Auteur', 'data' => ''
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Todolist::class,
            'authorRepository' => null,
        ]);
    }
    public function getChoices()
    {

       $choices = $this->authorRepository->getAuthors();
       $output['Sélectionner un auteur'] = '';
       foreach($choices as $key => $author) {
           $output[$author->getFullName()] = $author->getId();
       }
       return $output;
        
    }
}
