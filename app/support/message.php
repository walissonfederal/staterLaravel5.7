<?php


    namespace LaraDev\support;


    class message
    {
        private $text;
        private $type;

        public function getText()
        {
            return $this->text;
        }

        public function getType()
        {
            return $this->type;
        }

        public function success(string $message): message
        {
            $this->type = 'success';
            $this->text = $message;
            return $this;
        }

        public function error(string $message): message
        {
            $this->type = 'error';
            $this->text = $message;
            return $this;
        }

        public function render()
        {
            return "<div class='message {$this->getType()}'>{$this->getText()}</div>";
        }

    }
