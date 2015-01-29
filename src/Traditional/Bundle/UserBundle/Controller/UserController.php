<?php

namespace Traditional\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Traditional\Bundle\UserBundle\Command\RegisterUser;
use Traditional\Bundle\UserBundle\Entity\PhoneNumber;
use Traditional\Bundle\UserBundle\Entity\User;
use Traditional\Bundle\UserBundle\Form\CreateUserType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/list", name="traditional_user_list")
     * @Template
     */
    public function listAction()
    {
        $users = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('Traditional\Bundle\UserBundle\Entity\User')
            ->findAll();

        return array(
            'users' => $users
        );
    }

    /**
     * @Route("/create", name="traditional_user_create")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function createAction(Request $request)
    {
        //$user = new User();

        $form = $this->createForm(new CreateUserType());

        $form->handleRequest($request);

        if ($form->isValid()) {

            /** @var RegisterUser $command */
            $command = $form->getData();

            try {
                $this->get('command_bus')->handle($command);
            } catch(\Exception $e) {
                echo '<pre>';
                print_r($e);
            }

            return $this->redirect($this->generateUrl('traditional_user_list', [
                'id' => $command->getId(),
            ]));
        }

        return array(
            'form' => $form->createView()
        );
    }
}
