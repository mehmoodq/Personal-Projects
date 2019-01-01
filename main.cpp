#include <iostream>
using namespace std;

int main() {
	double interestRate, monthlyRate, loan;
	int months;
	cout << "Please input the interest rate for your loan: "; cin >> interestRate;
	monthlyRate = interestRate / 12 / 100;
	
	cout << "Please input the loan amount: "; cin >> loan;
	cout << "Please input the term of the loan in terms of years: "; cin >> months;
	months = months * 12;
	double monthlyPayment;

	monthlyPayment = pow(1 + monthlyRate, -months);
	monthlyPayment = 1 - monthlyPayment;
	monthlyPayment = monthlyRate / monthlyPayment;
	monthlyPayment = monthlyPayment * loan;

	cout << "You will end up paying $" << monthlyPayment << " per month and will pay back the loan in " << (months / 12) << " years" << endl;
	system("pause");
}