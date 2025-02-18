
import { HttpHeaders }    from '@angular/common/http';
import { Injectable }     from '@angular/core';
import { Observable, of } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class HttpService {

  constructor() { }

  getAPIGetReqHeaders() : {} {
    const opt = {
      headers: new HttpHeaders( {
        "Content-Type": "application/json",
        "json"        : "true"
      })
    };
    return opt;
  }

  /**
   * Handle Http operation that failed.
   * Let the app continue.
   * @param operation - name of the operation that failed
   * @param result - optional value to return as the observable result
   */
  handleError<T>( operation = 'operation', result?: T ) {
    return (error: any): Observable<T> => {
      // TODO: send the error to remote logging infrastructure
      console.error( error ); // log to console instead
      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }

}
