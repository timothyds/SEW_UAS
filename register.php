<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="login.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <title>REGISTRATION</title>
</head>
<body class=''>  
    <div id='container' class='relative'>
        <div id='content' class='float-left text-7xl mt-60 ml-40 text-violet-600'>
            <p class=''>Welcome To</p>
            <p>EDUCONCEPT</p>
        </div>

        <div class='flex justify-end'>
        <div id='aside' class=' mr-12 mt-12 text-center bg-violet-600 relative'>
            <img id='logo' class='block ml-auto mr-auto mt-10' src="img/logo-dummy.png" alt="logo-dummy">
            <br>
            <hr id='garis' class='mr-auto ml-auto mt-3 mb-10'>
            </label>
            <table class='ml-auto mr-auto' id='table-container'>
                <tr>
                    <td class='text-left'><label id='txtHakAkses' class=''>Hak Akses : &nbsp &nbsp &nbsp</label></td>
                    <td class='text-left'><label id='txtrd'><input type="radio" id='rdsiswa' name='rdHakAkses' value='siswa' class=''>    Siswa</label> &nbsp
                    <label id='txtrd'><input type="radio" id='rdtentor' name='rdHakAkses' value='tentor'>  Tentor</label></td>
                </tr>
                <tr>
                    <td class='text-left'><label id='txtUser'>Username : <span class ='text-red-700'>*</span>&nbsp &nbsp</label></td>
                    <td class='text-left'><input type="text" name='txtUsername' placeholder='  Type Your Username' class='h-8'></td>
                    
                </tr>
                <tr>
                    <td class='text-left'><label class=' ' id='txtPass'>Password : <span class ='text-red-700'>*</span>&nbsp &nbsp</label></td>
                    <td class='text-left'><input type="text" name='txtPassword' placeholder='  Type Your Password' class='h-8'></td>
                </tr>
                <tr>
                    <td class='text-left'><label id='txtEmail'>Email : <span class ='text-red-700'>*</span>&nbsp &nbsp</label></td>
                    <td class='text-left'><input type="text" name='txtEmail' placeholder='  Type Your Email' class='h-8'></td>
                </tr>
                <tr>
                    <td class='text-left'><label id='txtNoHP'>No. Handphone : <span class ='text-red-700'>*</span>&nbsp &nbsp</label></td>
                    <td class='text-left'><input type="text" name='txtNoHP' placeholder='  Type Your Phone Number' class='h-8'></td>
                </tr>
            </table>
            <button id='btnLogin' name='btnLogin' onclick="window.location.href='login.php'" class='mt-10 w-40 h-14 bg-white rounded-full'>Login</button> &nbsp &nbsp &nbsp &nbsp
            <button id='btnSubmit' name='btnSubmit' class='mt-10 w-40 h-14 bg-white rounded-full'>Submit</button>
            
        </div>
        </div>
    </div>
</body>
</html>