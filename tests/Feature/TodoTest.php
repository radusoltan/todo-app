<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_todo_can_be_added()
    {
        $response = $this->post('/todos',
            [
                "title"=>"New Todo",
                'description'=>'New Todo description',
                'is_completed'=>false
            ]
        );
        $todo = Todo::first();

        $this->assertCount(1, Todo::all());
    }

    /** @test */
    public function a_title_is_required()
    {
//        $this->withoutExceptionHandling();
        $response = $this->post('/todos', [
            'title' => '',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_todo_can_be_updated()
    {

        $this->post('/todos', $this->data());

        $todo = Todo::first();

        $response = $this->patch('/todo/'.$todo->id, [
            'title' => 'New Title'
        ]);

        $this->assertEquals('New Title', Todo::first()->title);
    }

    /** @test */
    public function a_todo_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->post('/todos', $this->data());

        $todo = Todo::first();
        $this->assertCount(1, Todo::all());

        $response = $this->delete('/todo/'.$todo->id);

        $this->assertCount(0, Todo::all());
    }

    /** @test */
    public function a_todo_can_be_set_as_complete()
    {
        $this->withoutExceptionHandling();
        $this->post('/todos', $this->data());

        $todo = Todo::first();

        $this->post('/todo/'.$todo->id.'/complete');

        $this->assertEquals(true, Todo::first()->is_completed);

    }

    /** @test */
    public function a_todo_can_be_set_as_incomplete()
    {
        $this->withoutExceptionHandling();
        $this->post('/todos', $this->data());

        $todo = Todo::first();

        $this->post('/todo/'.$todo->id.'/incomplete');

        $this->assertEquals(false, Todo::first()->is_completed);

    }

    /** @test */
    public function get_completed_todos()
    {

        $this->withoutExceptionHandling();

        $this->post('/todos',[
            'title' => 'Completed Todo',
            'description' => 'Completed todo description',
            'completed' => true
        ]);

        $this->get('/todos/completed');

        $this->assertCount(1, Todo::all());

    }

    /** @test */
    public function get_incompleted_todos()
    {

        $this->withoutExceptionHandling();

        $this->post('/todos',[
            'title' => 'Incompleted Todo',
            'description' => 'Incompleted todo description',
            'completed' => false
        ]);

        $this->get('/todos/incompleted');

        $this->assertCount(1, Todo::all());

    }

    private function data()
    {
        return [
            'title' => 'New Todo',
            'description' => 'New Todo description',
            'is_completed' => false
        ];
    }
}
