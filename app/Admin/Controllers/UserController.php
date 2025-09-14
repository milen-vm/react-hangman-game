<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User controller';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Име'))->sortable();
        $grid->column('surname', __('Фамилия'))->sortable();
        $grid->column('position', __('Длъжност'))->sortable();
        $grid->column('description', __('За мен'));
        $grid->column('interests', __('Интереси'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Име'));
        $show->field('surname', __('Фамилия'));
        $show->field('position', __('Длъжност'));
        $show->field('description', __('За мен'));
        $show->field('interests', __('Интереси'));
        
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->display('id', __('ID'));
        $form->text('name', __('Име'));
        $form->text('surname', __('Фамилия'));
        $form->text('position', __('Длъжност'));
        $form->textarea('description', __('За мен'));
        $form->textarea('interests', __('Интереси'));

        return $form;
    }
}
