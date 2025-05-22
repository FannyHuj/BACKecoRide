<?php

namespace App\Controller;

use App\dto\SignInDto;
use App\dtoConverter\UserDtoConverter;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use App\dtoConverter\SignInDtoConverter;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class UserController extends AbstractController
{

    #[Route('/api/newUser', methods:['POST'])] 
    public function new(Request $request, LoggerInterface $logger, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): JsonResponse {
    
         $hasPicture =false;
       
        // Vérification du champ 'picture' dans les fichiers uploadés
        if ($request->files->has('picture')) {
            $hasPicture=true;
            $picture = $request->files->get('picture');
            $logger->debug('Picture file received', [
                'originalName' => $picture->getClientOriginalName(),
                'mimeType' => $picture->getMimeType(),
                'size' => $picture->getSize(),
            ]);

            // Vous pouvez également vérifier le type MIME et la taille du fichier ici
            // Par exemple, vous pouvez vérifier si le type MIME est une image
            if (!in_array($picture->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
                return $this->json(['error' => 'Invalid image type'], 400);
            }
            if ($picture->getSize() > 8000000) { // 8 Mo
                return $this->json(['error' => 'Image size exceeds limit'], 400);
            }

            // Renommer le fichier pour éviter les conflits de nom
            $newFileName = uniqid() . '.' . $picture->guessExtension();
            $logger->debug('New file name', [
                'newFileName' => $newFileName,
            ]);
           
            $destination = $this->getParameter('kernel.project_dir') . '/public/assets/images';
            
            $picture->move($destination, $newFileName);
          
        } else {
            $logger->warning('No picture file received in form-data');
        }

        $signInDto = new SignInDto();   
        $signInDto->setFirstName($request->request->get('firstName'));
        $signInDto->setLastName($request->request->get('lastName'));
        $signInDto->setEmail($request->request->get('email'));
        $signInDto->setPassword($request->request->get('password'));
        $signInDto->setAddress($request->request->get('address'));
        $signInDto->setBirthDate(new \DateTime($request->request->get('birthDate')));
        $signInDto->setPhoneNumber($request->request->get('phoneNumber'));
        $signInDto->setRoles([$request->request->get('roles')]);
        if($hasPicture){
            $signInDto->setPicture($newFileName);
        }
        $signInDto->setCredit(20);
        
        $converter = new SignInDtoConverter(); 
        $newUser = $converter->converterToEntity($signInDto);
        $hashedPassword = $passwordHasher->hashPassword($newUser, $newUser->getPassword());
        $newUser->setPassword($hashedPassword);

        $userRepository->save($newUser);

        return $this->json(['status' => 'success']);
    }
    

    #[Route('/api/user/{email}')]
    public function getMail ($email,UserRepository $userRepository):JsonResponse{
        $user = $userRepository->findUserByEmail($email);
        $convert=new UserDtoConverter();
        return $this->json($convert->converterToDto($user));
    }
    

    #[Route('/api/admin/getAllUsers')]
    public function getAllUsers (UserRepository $userRepository): JsonResponse{

        $users= $userRepository->findAllUsers();

        $convert=new UserDtoConverter();
        $dtoList = [];

        foreach($users as $user){
            array_push($dtoList, $convert->converterToDto($user));
        }

        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/getAllEmployee')]
    public function getAllEmployee (UserRepository $userRepository): JsonResponse{

        $users= $userRepository->findAllEmployee();

        $convert=new UserDtoConverter();
        $dtoList = [];

        foreach($users as $user){
            array_push($dtoList, $convert->converterToDto($user));
        }

        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/user/{id}')]
    public function show (UserRepository $repository,$id): JsonResponse{

        $user= $repository->findUserById($id);
        $convert=new UserDtoConverter();
       
        $userDto=$convert->converterToDto($user);
        return $this->json($userDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/user/suspending/{id}', methods: ['PUT'])]
    public function suspendingMember($id, UserRepository $userRepository): JsonResponse {
    $user = $userRepository->findUserById($id);

    $convert=new UserDtoConverter();

    $userDto=$convert->converterToDto($user);
    $user->setActive(false);
    $userRepository->save($user);

    return $this->json($userDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/user/reactivate/{id}', methods: ['PUT'])]
    public function reactivateMember($id, UserRepository $userRepository): JsonResponse {
    $user = $userRepository->findUserById($id);

    $convert=new UserDtoConverter();

    $userDto=$convert->converterToDto($user);
    $user->setActive(true);
    $userRepository->save($user);

    return $this->json($userDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
}

}
