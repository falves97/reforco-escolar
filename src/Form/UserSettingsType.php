<?php

namespace App\Form;

use App\Entity\User;
use App\Services\AvatarService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\When;

class UserSettingsType extends AbstractType
{
    public function __construct(private AvatarService $avatarService)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $avatars = $this->avatarService->getAllAvatarsImages();

        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Primeiro nome',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Sobrenome',
            ])
            ->add('username', TextType::class)
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
            ])
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Senha atual',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new When('value', [new UserPassword()]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Nova senha',
                    'hash_property_path' => 'password',
                ],
                'second_options' => [
                    'label' => 'Confirme a nova senha',
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new When("this.getParent().get('currentPassword').getData()", [new NotBlank()]),
                ],
            ])
            ->add('defaultAvatar', ChoiceType::class, [
                'choices' => array_combine($avatars, $avatars),
                'mapped' => false,
                'expanded' => true,
                'placeholder' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'avatar_selected' => false,
        ]);
    }
}
