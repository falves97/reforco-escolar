<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextEditorType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['allowFileUpload'] = $options['allow_file_upload'];
        $view->vars['uploadUrl'] = $options['upload_url'];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'sanitize_html' => true,
            'upload_url' => '/trix/upload',
        ]);

        $resolver->setAllowedTypes('upload_url', ['string']);
    }

    public function getBlockPrefix(): string
    {
        return 'texteditor';
    }

    public function getParent(): ?string
    {
        return TextareaType::class;
    }
}
