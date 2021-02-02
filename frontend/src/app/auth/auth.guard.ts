
import { Injectable }                                                       from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, Router } from '@angular/router';
import { Observable, of }                                                   from 'rxjs';
import { map, catchError }                                                  from "rxjs/operators";

import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {

  // using the Router here will allow us to redirect the user to login-signup-shell if not authenticated
  constructor( private authService:AuthService, private router:Router ) {}

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean> {
    return this.authService.isAuthenticated()
      .pipe(
        map( response => {
          if ( response === true ) {
              return true;
          }
          this.router.navigate(['/auth']);
          return false;
        }),
        catchError((error) => {
          this.router.navigate(['/auth']);
          return of(false);
    }));
  }

}
