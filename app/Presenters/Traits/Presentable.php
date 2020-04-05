<?php

namespace Kouloughli\Presenters\Traits;

trait Presentable
{
    /**
     * @var \Kouloughli\Presenters\Presenter
     */
    protected $presenterInstance;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function present()
    {
        if (is_object($this->presenterInstance)) {
            return $this->presenterInstance;
        }
        if (property_exists($this, 'presenter') and class_exists($this->presenter)) {
            return $this->presenterInstance = new $this->presenter($this);
        }
        throw new \Exception('Property $presenter was not set correctly in '.get_class($this));
    }
}
