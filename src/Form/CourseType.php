<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $years = $this->getYearsOptions();

        $builder
            ->add('name')
            ->add('description', TextEditorType::class)
            ->add('grade')
            ->add('year', ChoiceType::class, [
                'choices' => $years,
            ])
            ->add('published');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }

    private function getYearsOptions(): array
    {
        $current = new \DateTimeImmutable();
        $current = intval($current->format('Y'));
        $start = $current - 5;
        $end = $current + 5;

        $years = [];

        for ($i = $start; $i <= $end; ++$i) {
            $years[] = $i;
        }

        return array_combine($years, $years);
    }
}
