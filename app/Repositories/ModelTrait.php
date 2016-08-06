<?php
/**
 * ModelTrait
 *
 * @author Rafael
 */
namespace App\Repositories;

/**
 * Trait ModelTrait
 *
 * This trait exists so that repository and other classes can store a
 * dependent model as a property without having a re-entrancy issue
 * where queries are issued against the model object multiple times
 * in a request.
 */
trait ModelTrait
{
    /** @var \Illuminate\Database\Eloquent\Model */
    protected $model;

    /**
     * Get a new instance of the model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return new $this->model;
    }

    /**
     * Get the name of the stored model
     *
     * @return string
     */
    public function getModelClass()
    {
        return $this->model;
    }

    /**
     * Set the model used by the class
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function setModel($model)
    {
        $this->model = get_class($model);
    }

    /**
     * Return all records
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
    public function getRecords()
    {
        try {
            return $this->getModel()->get();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Return a single record
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function getRecord($id)
    {
        try {
            return $this->getModel()->find($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Add a single record
     *
     * @param array $record
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function addRecord(array $record)
    {
        try {
            return $this->getModel()->create($record);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update a single record
     *
     * @param integer $id
     * @param array $record
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function updateRecord($id, array $record)
    {
        try {
            $objRecord = $this->getModel()->find($id);

            if (! empty($objRecord)) {
                return $objRecord->update($record);
            }
            return false;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Delete a single record
     *
     * @param integer $id
     * @return boolean
     * @throws \Exception
     */
    public function deleteRecord($id)
    {
        try {
            return $this->getModel()->destroy($id);
        } catch (\Exception $e) {
            // error calling the callback function of the web product
            Log::error(__CLASS__.':'.__TRAIT__.':'.__FILE__.':'.__LINE__.':'.__FUNCTION__.':'.
                "Exception thrown while deleting a record", [
                'data'            => $id,
                'model'           => $this->getModel()->getTable(),
                'exception_type'  => get_class($e),
                'message'         => $e->getMessage(),
                'code'            => $e->getCode(),
            ]);
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
