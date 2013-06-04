<?php

namespace Acl\Controller;

use Common\AbstractController;

class Role extends AbstractController
{

    public function novoAction()
    {

        $form = $this->getForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            try {
                $form->validate();
                $this->getService()->insert($form->getData());
                $this->success($this->getMessage('insert', 'success'));
                $this->redirect()->toRoute('crud', array('controller' => $this->controller));
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }

        return array('form' => $form);
    }

}