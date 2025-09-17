<?php

namespace App\Admin\Controllers;

use App\Models\Project;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Project controller';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Project);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('Название'))->sortable();
        $grid->column('description', __('Описание'));
        $grid->column('link', __('Линк'))->display(function ($link) {

            return "<a href='{$link}' title='Към проекта!' target='_blanck'>връзка</a>";
        });
        $grid->column('image', __('Картинка'))->image();

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
        $show = new Show(Project::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('title', __('Название'));
        $show->field('description', __('Описание'));
        $show->field('link', __('Линк'));
        $show->field('image', __('Картинка'))->image();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Project);

        $form->display('id', __('ID'));
        $form->text('title', __('Название'));
        $form->textarea('description', __('Описание'));
        $form->text('link', __('Линк'));
        $form->image('image', __('Картинка'));

        return $form;
    }
}
