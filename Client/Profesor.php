<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <style>
      .modal {
        display: none; /* Modal hidden by default */
      }
      .modal-open {
        display: flex; /* Display modal when active */
      }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
<?php include './Components/Profeseorheader.php'; 
include '../server/config/db/db.php'; // Include your database connection file
include '../server/Profesor.php';
include '../server/Entity/Student.entity.php';
include "../server/auth.php";
session_start();
Auth::isAuth();

Auth::protectRoute('profesor');
$profesor = new Profesor($db);
$students = $profesor->getStudents();
// print_r($students)
?>

<div class="overflow-x-auto mt-20">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Table Title</h2>
        <button id="openAddModal" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Add</button>
    </div>
    <table class="table-auto mx-auto bg-white shadow-md rounded-lg">
      <thead>
        <tr>
          <th class="px-4 py-2">Id</th>
          <th class="px-4 py-2">Full Name</th>
          <th class="px-4 py-2">Age</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Phone number</th>
          <th class="px-4 py-2">Address</th>
          <th class="px-4 py-2">Password</th>
          <th class="px-4 py-2">Profile Image</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($student->getId()); ?></td>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($student->getFullName()); ?></td>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($student->getAge()); ?></td>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($student->getEmail()); ?></td>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($student->getPhoneNumber()); ?></td>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($student->getAddress()); ?></td>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($student->getPassword()); ?></td>
            <td class="border px-4 py-2">
                <img src="<?php echo '../Assets/Student/'. htmlspecialchars($student->getProfileImage()); ?>" alt="Profile Image" class="w-16 h-16 object-cover rounded">
            </td>
            <td class="border px-4 py-2">
                <button class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-700 edit-button" data-id="<?php echo htmlspecialchars($student->getId()); ?>">Edit</button>
                <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700 delete-button" data-id="<?php echo htmlspecialchars($student->getId()); ?>">Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
    </table>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 items-center justify-center bg-gray-900 bg-opacity-50 modal">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h3 class="text-lg font-semibold mb-4">Add New Student</h3>
        <form action="./utils/createStudent.php" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="add-full-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" id="add-full-name" name="full_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm py-2 px-4 text-lg focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm" />
            </div>
            <div class="mb-4">
                <label for="add-age" class="block text-sm font-medium text-gray-700">Age</label>
                <input type="text" id="add-age" name="age" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm py-2 px-4 text-lg focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm" />
            </div>
            <div class="mb-4">
                <label for="add-grade" class="block text-sm font-medium text-gray-700">Grade</label>
                <input type="text" id="add-grade" name="grade" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm py-2 px-4 text-lg focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm" />
            </div>
            <div class="mb-4">
                <label for="add-phone-number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" id="add-phone-number" name="phone_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm py-2 px-4 text-lg focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm" />
            </div>
            <div class="mb-4">
                <label for="add-profile-image" class="block text-sm font-medium text-gray-700">Profile Image</label>
                <input type="file" id="add-profile-image" name="profile_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm py-2 px-4 text-lg focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm" />
            </div>
            <div class="mb-4">
                <label for="add-profile-image" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="add-profile-image" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm py-2 px-4 text-lg focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm" />
            </div>
            <div class="mb-4">
                <label for="add-profile-image" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" id="add-profile-image" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm py-2 px-4 text-lg focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm" />
            </div>
            <div class="mb-4">
                <label for="add-profile-image" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" id="add-profile-image" name="adress" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm py-2 px-4 text-lg focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm" />
            </div>
            <div class="flex justify-end">
                <input type="submit" id="saveStudentButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 items-center justify-center bg-gray-900 bg-opacity-50 modal">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h3 class="text-lg font-semibold mb-4">Edit Student</h3>
        <form action="./utils/updateStudent.php" method="PUT">
            <input type="hidden" id="edit-id" name="student_id" />
            <div class="mb-4">
                <label for="edit-full-name" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" id="edit-full-name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm py-2 px-4 text-lg focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm" name="email" />
            </div>
            <div class="flex justify-end">
                <input type="submit" id="saveStudentButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 items-center justify-center bg-gray-900 bg-opacity-50 modal">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h3 class="text-lg font-semibold mb-4">Delete Student</h3>
        <p>Are you sure you want to delete this student?</p>
        <form action="./utils/deleteStudent.php" method="DELETE">
            <input type="hidden" id="delete-id" name="student_id" />
            <div class="flex justify-end mt-4">
                <button type="button" id="cancelDelete" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 mr-2">Cancel</button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
  document.getElementById('openAddModal').addEventListener('click', function() {
    document.getElementById('addModal').classList.add('modal-open');
});

const closeAddModal = document.getElementById('closeAddModal');
if (closeAddModal) {
    closeAddModal.addEventListener('click', function() {
        document.getElementById('addModal').classList.remove('modal-open');
    });
}

const editButtons = document.querySelectorAll('.edit-button');
if (editButtons) {
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            document.getElementById('edit-id').value = this.getAttribute('data-id');
            
            document.getElementById('editModal').classList.add('modal-open');
        });
    });
}

const deleteButtons = document.querySelectorAll('.delete-button');
if (deleteButtons) {
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('delete-id').value = this.getAttribute('data-id');
            document.getElementById('deleteModal').classList.add('modal-open');
        });
    });
}

const cancelDelete = document.getElementById('cancelDelete');
if (cancelDelete) {
    cancelDelete.addEventListener('click', function() {
        document.getElementById('deleteModal').classList.remove('modal-open');
    });
}

document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', function(event) {
        if (event.target === this) {
            this.classList.remove('modal-open');
        }
    });
});
</script>
</body>
</html>
