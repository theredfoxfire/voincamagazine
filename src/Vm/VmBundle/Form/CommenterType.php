<?php

namespace Vm\VmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommenterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment','textarea', array('label'=>'Komentar'))
			->add('submit', 'submit', array('label' => 'Post a comment!'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vm\VmBundle\Entity\Commenter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vm_vmbundle_commenter';
    }
}
