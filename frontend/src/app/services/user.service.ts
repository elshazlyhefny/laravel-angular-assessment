// src/app/services/user.service.ts
import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http'; // Import HttpClient and HttpParams for making HTTP requests
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  private apiUrl = 'http://localhost/api/v1/users'; // Replace with your actual API endpoint URL

  constructor(private http: HttpClient) {} // Inject HttpClient to make HTTP requests

  getUsers(
    providerFilter: string,
    statusFilter: string,
    balanceMinFilter: number | null,
    balanceMaxFilter: number | null,
    currencyFilter: string
  ): Observable<any[]> {
    // Set up the query parameters
    let params = new HttpParams();
    params = params.append('provider', providerFilter);
    params = params.append('statusCode', statusFilter);
    if (balanceMinFilter !== null) {
      params = params.append('balanceMin', balanceMinFilter.toString());
    }
    if (balanceMaxFilter !== null) {
      params = params.append('balanceMax', balanceMaxFilter.toString());
    }
    params = params.append('currency', currencyFilter);

    // Make the HTTP GET request to the API with the query parameters
    return this.http.get<any[]>(this.apiUrl, { params });
  }
}
