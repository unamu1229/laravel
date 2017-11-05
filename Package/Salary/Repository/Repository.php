<?php


namespace Package\Salary\Repository;


class Repository
{
    protected function setModelPropertyToEloquent($model, $eloquent)
    {
        $reflect = new \ReflectionClass($model);
        foreach ($reflect->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED) as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            $propertyName = $reflectionProperty->getName();
            $eloquent->$propertyName = $reflectionProperty->getValue($model);
        }
        $eloquent->save();
    }

    public function getArgValueById($id, $value)
    {
        return $this->eloquent->where('empId', $id)->value($value);
    }

    public function getAllWhereColumnValue($columnName, $value)
    {
        return $this->eloquent->where($columnName, $value)->get();
    }
}