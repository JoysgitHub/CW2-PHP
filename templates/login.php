

<div class="dark:bg-gray-900 h-screen overflow-hidden flex items-center justify-center">

<div class="bg-white lg:w-4/12 md:6/12 w-10/12 shadow-3xl rounded-xl" > 
	<div class="mt-5">
<div class="mt-4">
	<img src="/CW2-PHP/img/logo_uni.png" class="w-25  h-25 mx-auto rounded-t-xl mt-4" alt="Image">


	<form class="p-122 md:p-24 " name="frmLogin" action="authenticate.php" method="post">
		
	<div class="flex flex-col"> 
		<div>
		<label for="studentid" class="block mb-2 font-bold text-xl text-center">StudentId</label>             <input class="w-full px-4 py-2 mt-2 border border-gray-400 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" name="txtid" type="text" required />  


		</div>
		<br/>

		<label for="studentid" class="block mb-2 font-bold text-xl text-center">Password</label>        <input class="w-full px-4 py-2 mt-2 border border-gray-400 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" name="txtpwd" type="password" required />
   
		<br/>
		<button class="px-10 py-3 mt-4 text-white bg-blue-900 rounded-lg hover:bg-blue-600" type="submit" value="Login" name="btnlogin"> Login</button>
	
	</div>
	</form>


	</div>
</div>



