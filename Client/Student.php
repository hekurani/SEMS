<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="bg-gray-100">
<header>
<?php 
session_start();
include './Components/Studentheader.php'; 
include "../server/auth.php";
include '../server/config/db/db.php';
Auth::protectRoute('student');
Auth::isAuth();
$auth=new Auth($db);
if(isset($_SESSION['role'])){
 
$response=$auth->getProfile($_SESSION['user_id']);

}
?>

  <div class="flex justify-center mt-20 px-8">
    <form class="max-w-2xl" method="POST" action="./utils/updateMe.php">
        <div class="flex flex-wrap border shadow rounded-lg p-3 dark:bg-gray-600">
            <h2 class="text-xl text-gray-600 dark:text-gray-300 pb-2">Account settings:</h2>

            <div class="flex flex-col gap-2 w-full border-gray-400">

                <div>
                    <label class="text-gray-600 dark:text-gray-400">Full Name</label>
                    <input
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow dark:bg-gray-600 dark:text-gray-100"
                        type="text" value="<?php echo $response['Full_name']?>" name="Full_name">
                </div>

                <div>
                    <label class="text-gray-600 dark:text-gray-400">Age</label>
                    <input
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow dark:bg-gray-600 dark:text-gray-100"
                        type="text" value="<?php echo $response['age']?>" name="age">
                </div>
                <div>
                    <label class="text-gray-600 dark:text-gray-400">Adress</label>
                    <input
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow dark:bg-gray-600 dark:text-gray-100"
                        type="text" value="<?php echo $response['adress']?>" name="adress">
                </div>
                <div class="flex justify-end">
                    <input
                        class="py-1.5 px-3 m-1 text-center bg-violet-700 border rounded-md text-white hover:bg-violet-500 hover:text-gray-100 dark:text-gray-200 dark:bg-violet-700"
                        type="submit">
                </div>
            </div>
        </div>
    </form>
  </div>



  
     
  </div>
</header>
</body>
</html>
