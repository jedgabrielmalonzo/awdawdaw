const validation = new JustValidate("#signup");


validation 
.addField("#username", [
{
    rule: "required"
}
])
.addField("#email", [
    {
        rule: "required"
    },
    {
        rule: "email"
    },
    {
        validator: (value) => () =>{
            return fetch("../PHP/validate-email.php?email=" + encodeURIComponent(value))
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        return json.available;
                    })
        },
        errorMessage: "email already taken"
    }
    ])
.addField("#password", [
    {
         rule: "required"
    },
    {
        rule: "password"
    }
    ])
    .addField("#confirm-password", [
    {
        validator: (value, fields) => {
            return value === fields ['#password'].elem.value;
            
    },
        
        errorMessage: "Passwords should match"
    }
    ])
    .onSuccess((event) =>{
        document.getElementById("signup").submit();
    });