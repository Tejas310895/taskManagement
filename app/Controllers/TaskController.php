<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class TaskController extends ResourceController
{
    protected $modelName = 'App\Models\TaskModel';
    protected $format    = 'json';

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function index($id = null): ResponseInterface
    {
        try {
            if ($id === null) {
                $data = $this->model->findAll();
            } else {
                $data = $this->model->find(["id" => $id]);
            }
            return $this->setResponseFormat('json')->respond($data, 200);
        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create(): ResponseInterface
    {
        try {
            $postData =  $this->request->getPost();
            $data = $this->model->insert($postData);
            if(date('Y-m-d',strtotime($postData['due_date'])) < date('Y-m-d')){
                return $this->failValidationErrors('Due date cannot be of past');
            }
            if ($data) {
                return $this->respondCreated($data);
            } else {
                return $this->failValidationErrors($this->model->errors());
            }
        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int $id
     *
     * @return ResponseInterface
     */
    public function update($id = null): ResponseInterface
    {
        try {
            $postData =  json_decode($this->request->getBody(),true);
            if(date('Y-m-d',strtotime($postData['due_date'])) < date('Y-m-d')){
                return $this->failValidationErrors('Due date cannot be of past');
            }
            $data = $this->model->update($id,$postData);
            if ($data) {
                return $this->respondUpdated($data, 'Task Updated Successfully');
            } else {
                return $this->failValidationErrors($this->model->errors());
            }
        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null): ResponseInterface
    {
        try {
            $data = $this->model->delete($id);
            if ($data) {
                return $this->respondDeleted($data,'Task Deleted Successfully');
            } else {
                return $this->failValidationErrors($this->model->errors());
            }
        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }
    }
}
