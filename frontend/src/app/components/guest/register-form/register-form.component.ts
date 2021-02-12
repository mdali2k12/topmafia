
import { Component, OnInit }                  from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-register-form',
  templateUrl: './register-form.component.html',
  styleUrls: ['./register-form.component.scss']
})
export class RegisterFormComponent implements OnInit {

  isSubmitted = false;
  registerForm: FormGroup;

  constructor() { }

  ngOnInit(): void {
    this.registerForm = new FormGroup( {
      "username"       : new FormControl(
        null,
        Validators.required
      ),
      "passwordData": new FormGroup( {
        "password" : new FormControl(
          null,
          Validators.required
        ),
        "confirmPassword": new FormControl(
          null,
          Validators.required
        )
      }),
      "email"          : new FormControl(
        null,
        [Validators.required, Validators.email]
      ),
      "gender"         : new FormControl( "Male" ),
      "sponsorId"      : new FormControl( null )
    });
  }

  onSubmit() : void {
    console.log( this.registerForm );
    this.isSubmitted = true;
  }

}
