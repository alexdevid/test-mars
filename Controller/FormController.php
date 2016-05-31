<?php
namespace Controller;

use Model\Order;
use Service\XMLDumper;

class FormController
{
    public function indexAction()
    {
        $data = $this->getPostData();
        $errors = [];

        if ($data) {
            $order = Order::fromArray($data);
            if ($order->validate()) {
                //var_dump($order->toArray());
                return $this->render('success', [
                    'xml' => $this->dumpOrder($order)
                ]);
            } else {
                $errors = $order->getErrors();
            }
        } else {
            $order = new Order();
        }

        return $this->render('form', [
            'order' => $order,
            'errors' => $errors
        ]);
    }

    /**
     * @param Order $order
     * @return string
     */
    private function dumpOrder(Order $order)
    {
        $dumper = new XMLDumper($order->toArray());
        return $dumper->dump();
    }

    /**
     * @param string $template
     * @param array $data
     * @return string
     */
    private function render($template, array $data = [])
    {
        $viewDir = __DIR__ . '/../View/';
        $fileName = $viewDir . $template . '.php';
        foreach ($data as $varName => $value) {
            $$varName = $value;
        }
        ob_start();
        require_once($fileName);
        $content = ob_get_clean();
        require_once($viewDir . 'layout.php');
        return ob_get_clean();

    }

    /**
     * @return mixed
     */
    private function getPostData()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $_POST;
        }
        return false;
    }
}