
import { Component, OnInit }      from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-register-form',
  templateUrl: './register-form.component.html',
  styleUrls: ['./register-form.component.scss']
})
export class RegisterFormComponent implements OnInit {

  registerForm: FormGroup;

  constructor() { }

  ngOnInit(): void {
    this.registerForm = new FormGroup( {
      "username"       : new FormControl( null ),
      "password"       : new FormControl( null ),
      "confirmPassword": new FormControl( null ),
      "email"          : new FormControl( null ),
      "gender"         : new FormControl( "Male" ),
      "sponsorId"      : new FormControl( null )
    });
  }

}
