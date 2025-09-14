<?php

namespace App\Admin\Controllers;

use App\Models\Experience;
use App\Models\Technology;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExperienceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Experience controller';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Experience);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('position', __('Длъжност'))->sortable();
        $grid->column('short_description', __('Кратко описание'))->sortable();
        $grid->column('date_from', __('От дата'))->date();
        $grid->column('date_to', __('До дата'))->date();
        $grid->column('company_name', __('Компания'))->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Experience::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('position', __('Длъжност'));
        $show->field('short_description', __('Кратко описание'));
        $show->field('date_from', __('От дата'));
        $show->field('date_to', __('До дата'));
        $show->field('company_name', __('Компания'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Experience);

        $form->display('id', __('ID'));
        $form->text('position', __('Длъжност'));
        $form->textarea('short_description', __('Кратко описание'));
        $form->date('date_from', __('От дата'));
        $form->date('date_to', __('До дата'));
        $form->text('company_name', __('Компания'));
        $form->multipleSelect('technologies', __('Технологии'))->options(Technology::all()->pluck('title', 'id'));

        return $form;
    }
}
