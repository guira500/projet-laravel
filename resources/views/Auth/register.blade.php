<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <title>inscription</title>
</head>
<body>
    
    <form action="{{route('register.save')}}" method="post" style="margin-left: 50px; margin-top: 20px;">
        @csrf
        <div class="row">
            <div class="col-5">
                <h2 class="text-center alert alert alert-warning">Information Enseignant</h2>
                <div class="mb-3">
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" id="exampleInputPassword1">
                    @error('nom')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Prenom</label>
                    <input type="text" name="prenom" class="form-control" id="exampleInputPassword1">
                    @error('prenom')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Matricule</label>
                    <input type="text" name="matricule" class="form-control" id="exampleInputPassword1">
                    @error('matricule')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="exampleInputPassword1">
                    @error('email')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    @error('password')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirmer le mot de passe</label>
                    <input type="confirm-password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
                    @error('password_confirmation')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </div>
      </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>

</body>
</html>