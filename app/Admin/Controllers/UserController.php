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
        $grid->column('image', __('Снимка'))->image('/storage');
        $grid->column('telegram', __('Телеграм'))->display(function ($link) {

            return $link ? "<a href='{$link}' title='Телеграм' target='_blanck'>връзка</a>" : '-';
        });
        $grid->column('gitlab', __('Гитлаб'))->display(function ($link) {

            return $link ? "<a href='{$link}' title='Гитлаб' target='_blanck'>връзка</a>" : '-';
        });
        $grid->column('github', __('Гитхъб'))->display(function ($link) {

            return $link ? "<a href='{$link}' title='Гитхъб' target='_blanck'>връзка</a>" : '-';
        });

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
        $show->field('image', __('Снимка'))->image('/storage');
        $show->field('telegram', __('Телеграм'));
        $show->field('gitlab', __('Гитлаб'));
        $show->field('github', __('Гитхъб'));
        
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
        $form->image('image', __('Снимка'));
        $form->text('telegram', __('Телеграм'));
        $form->text('gitlab', __('Гитлаб'));
        $form->text('github', __('Гитхъб'));

        return $form;
    }
}
