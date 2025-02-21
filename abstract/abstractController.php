<?php

abstract class AbstractController {
    //ATTRIBUTS
    private ViewHeader $header;
    private ViewFooter $footer;
    private InterfaceModel $model;

    public function __construct(ViewHeader $header, ViewFooter $footer, InterfaceModel $model){
        $this->header = $header;
        $this->footer = $footer;
        $this->model = $model;
    }
    
    //GETTER ET SETTER
    public function getHeader(): ViewHeader{
        return $this->header;
    }

    public function setHeader(ViewHeader $header): self{
        $this->header = $header;
        return $this;
    }

    public function getFooter(): ViewFooter{
        return $this->footer;
    }

    public function setFooter(ViewFooter $footer): self{
        $this->footer = $footer;
        return $this;
    }

    public function getModel(): InterfaceModel{
        return new ModelPlayer();
    }

    public function setModel(InterfaceModel $model): self{
        $this->model = $model;
        return $this;
    }

    //METHOD
    public abstract function render():void;

    public function renderHeader(): void {
        $header = $this->getHeader()->displayView();
        echo $header;
    }
    
    public function renderFooter(): void {
        $footer = $this->getFooter()->displayView();
        echo $footer;
    }
}