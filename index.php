<?php
    class Student{
        private $studentId;
        private $studentName;

        public function __construct($studentId, $studentName)
        {
            $this->studentId = $studentId;
            $this->studentName = $studentName;
        }

        public function print(){
            return "Welcome";
        }
    }

    $student = new Student(123, 'Ali');
    echo $student->print();
?>