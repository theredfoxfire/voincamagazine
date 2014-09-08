<?php

namespace Vm\VmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Vm\VmBundle\Entity\Knowledge;

class KnowledgeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('writer')
            ->add('file', 'file', array('label' => 'Gambar', 'required' => false))
            ->add('title')
            ->add('knowledge')
            ->add('is_activated')
            ->add('writer_email')
            ->add('category')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vm\VmBundle\Entity\Knowledge'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vm_vmbundle_knowledge';
    }
}
