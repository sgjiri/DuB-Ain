<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Form\Type\ImageType;
use App\Entity\SiteImage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;


class SiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Site::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->hideOnForm(),
            yield TextField::new('name'),
            yield TextField::new('localisation'),
            yield TextEditorField::new('description'),
            yield NumberField::new('surface'),
            yield NumberField::new('price'),
            yield NumberField::new('duration'),
            yield CollectionField::new('siteImages')->setEntryType(ImageType::class),
        ];
    }
}
