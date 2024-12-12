<?php

declare(strict_types=1);

namespace Querify\Infrastructure\Symfony\Form\ExternalServiceConfiguration;

use Querify\Domain\User\User;
use Querify\Domain\User\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ExternalServiceConfigurationFormType extends AbstractType
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('externalServiceName', type: TextType::class, options: [
                'disabled' => true,
            ])
            ->add('eligibleApprovers', type: ChoiceType::class, options: [
                'choices' => $this->userRepository->getAll(),
                'multiple' => true,
                'required' => false,
                'choice_value' => static fn (User $user) => $user->uuid,
                'choice_label' => static fn (User $user) => \sprintf('%s (%s)', $user->name, $user->email),
            ])
            ->add('save', SubmitType::class, ['label' => 'Submit'])
        ;
    }
}
