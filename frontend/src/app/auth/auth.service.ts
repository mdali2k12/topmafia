import { Injectable } from '@angular/core';
import { of }         from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor() { }

  // TODO get that information from calls to API with tokens
  isAuthenticated() {
    return of( false );
  }

}
