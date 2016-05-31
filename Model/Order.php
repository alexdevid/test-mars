<?php
namespace Model;

class Order
{
    /**
     * @var string
     */
    protected $firstName;
    /**
     * @var string
     */
    protected $lastName;
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $date;
    /**
     * @var string
     */
    protected $number;
    /**
     * @var string
     */
    protected $comment;
    /**
     * @var array
     */
    private $errors = [];
    /**
     * @var array
     */
    private $validationRules = [
        'firstName' => [
            'pattern' => '/^[a-zA-Z\s]*$/',
            'message' => 'В имени допускаются только латинские буквы, пробелы и дефисы'
        ],
        'lastName' => [
            'pattern' => '/^[a-zA-Z\s]*$/',
            'message' => 'В Фамилии допускаются только латинские буквы, пробелы и дефисы'
        ],
        'id' => [
            'pattern' => '/^[A-Za-z]{1}[0-9]{5}[A-Za-z]{2}$/',
            'message' => 'Номер тарелки в формате &laquo;x12345xx&raquo;'
        ],
        'date' => [
            'pattern' => '/^(\d{4})-(\d{2})-(\d{2})$/',
            'message' => 'Дата должна быть в формате &laquo;ГГГГ-ММ-ДД&raquo;'
        ],
        'number' => [
            'pattern' => '/^[A-Fa-f0-9]{12}$/',
            'message' => 'Телекоммуникационный номер должен состоять из 12 шестнадцатеричных цифр (пример: &laquo;fc62e12c43a6&raquo;),'
        ],
        'comment' => [
            'pattern' => '/.{0,}/',
            'message' => ''
        ],
    ];

    /**
     * @param array $data
     * @return Order
     */
    public static function fromArray(array $data)
    {
        $order = new self;
        foreach ($data as $field => $value) {
            if (property_exists($order, $field)) {
                $setterName = 'set' . ucfirst($field);
                $order->$setterName(filter_var($value, FILTER_SANITIZE_STRING));
            }
        }
        return $order;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];
        $reflector = new \ReflectionClass(get_class(new self));
        foreach ($this as $property => $value) {
            if ($reflector->getProperty($property)->isProtected()) {
                $data[$property] = $value;
            }
        }
        return $data;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        $invalid = false;
        foreach ($this->validationRules as $property => $rules) {
            if (!preg_match($rules['pattern'], $this->$property)) {
                $invalid = true;
                $this->errors[$property] = $rules['message'];
            }
        }
        return !$invalid;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setFirstName($name) {
        $name = htmlspecialchars(strip_tags($name));
        $this->firstName = ucwords($name);
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setLastName($name) {
        $name = htmlspecialchars(strip_tags($name));
        $this->lastName = ucwords($name);
        return $this;
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setDate($date) {
        $this->date = htmlspecialchars(strip_tags($date));
        return $this;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id) {
        $this->id = htmlspecialchars(strip_tags($id));
        return $this;
    }

    /**
     * @param string $number
     * @return $this
     */
    public function setNumber($number) {
        $this->number = htmlspecialchars(strip_tags($number));
        return $this;
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment) {
        $this->comment = htmlspecialchars(strip_tags($comment));
        return $this;
    }
}