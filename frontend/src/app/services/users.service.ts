
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable }              from '@angular/core';
import { Observable }              from 'rxjs';
import { catchError }              from 'rxjs/operators';

import { HttpService } from './http.service';
import { environment } from "./../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class UsersService {

  private _env      = environment;
  private _usersUrl = this._env.APIUrl + "/users";

  constructor( private _httpService: HttpService, private _http:HttpClient ) { }

  getUsersData(): Observable<any[] | JSON> {
    return this._http.get<JSON>( this._usersUrl, this._httpService.getAPIGetReqHeaders() )
            .pipe(
              catchError( this._httpService.handleError( "get users data", [] ) )
    );
  }

}
