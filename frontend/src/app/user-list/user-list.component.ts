// src/app/user-list/user-list.component.ts
import { Component, OnInit } from '@angular/core';
import { UserService } from '../services/user.service'; // Import the UserService or any service to get user data

@Component({
  selector: 'app-user-list',
  templateUrl: './user-list.component.html',
  styleUrls: ['./user-list.component.css'],
})
export class UserListComponent implements OnInit {
  users: any[] = []; // Array to store user data
  filteredUsers: any[] = []; // Initialize the array with an empty array

  providerFilter: string = 'both'; // Input field for provider filter
  statusFilter: string = ''; // Input field for status code filter
  balanceMinFilter: number | null = null; // Input field for balance min filter
  balanceMaxFilter: number | null = null; // Input field for balance max filter
  currencyFilter: string = ''; // Input field for currency filter

  constructor(private userService: UserService) {} // Inject the UserService or any other service to get user data

  ngOnInit() {
    this.getUsers(); // Call the method to get user data
  }

  getUsers() {
    // Call the UserService to get user data with the filter criteria
    this.userService.getUsers(
      this.providerFilter,
      this.statusFilter,
      this.balanceMinFilter,
      this.balanceMaxFilter,
      this.currencyFilter
    ).subscribe(
      (data) => {
        this.users = data; // Assign the user data to the component property
        this.filteredUsers = data; // Initialize filteredUsers with all users initially
        this.applyFilters(); // Apply initial filters
      },
      (error) => {
        console.error('Error:', error);
      }
    );
  }

  applyFilters() {
    // Apply filters based on input fields
    this.filteredUsers = this.users.filter((user) => {
      // Filter by provider
      let providerMatch =  user.provider;
      if (this.providerFilter !='both') {
        providerMatch = user.provider.toLowerCase().includes(this.providerFilter.toLowerCase());
      }
      // Filter by status code
      const statusMatch = user.statusCode.toString().includes(this.statusFilter);
      // Filter by balance range
      const balanceMin = this.balanceMinFilter !== null ? this.balanceMinFilter : Number.MIN_SAFE_INTEGER;
      const balanceMax = this.balanceMaxFilter !== null ? this.balanceMaxFilter : Number.MAX_SAFE_INTEGER;
      const balanceMatch = user.balance >= balanceMin! && user.balance <= balanceMax!;

      // Filter by currency
      const currencyMatch = user.currency.toLowerCase().includes(this.currencyFilter.toLowerCase());

      return providerMatch && statusMatch && balanceMatch && currencyMatch;
    });
  }
}
