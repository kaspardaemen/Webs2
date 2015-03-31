



    <form action="{{ URL::route('account-create-post') }}" method="post">

            <div class="field">
            Email: <input type="text" name="email" >
            </div>

             <div class="field">
             Gebruikersnaam: <input type="text" name="username" >
             </div>

             <div class="field">
             Wachtwoord: <input type="password" name="password" >
             </div>
           <input type="submit" value="Registreer ">
           {{ Form::token() }}
     </form>