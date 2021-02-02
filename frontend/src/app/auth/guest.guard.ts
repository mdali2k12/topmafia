
import { Injectable }                                                       from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, Router } from '@angular/router';
import { Observable, of }                                                   from 'rxjs';
import { map, catchError }                                                  from "rxjs/operators";

import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class GuestGuard implements CanActivate {

  // using the Router here will allow us to redirect the user to game-shell page if authenticated
  constructor( private authService:AuthService, private router:Router ) {}

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean> {
      return this.authService.isAuthenticated()
      .pipe(
        map( response => {
          if ( response === false ) {
              return true;
          }
          this.router.navigate(['/game']);
          return false;
        }),
        catchError((error) => {
          this.router.navigate(['/game']);
          return of(false);
    }));
  }

}
