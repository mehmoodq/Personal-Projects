#include <iostream>
using namespace std;

int main() {
	cout << "Please input a number greater than 1: ";
	int n; cin >> n;
	int steps = 0;

	while (n <= 1) {
		cout << "ERROR: Please input a number greater than 1" << endl;
		cin >> n;
	}

	while (n != 1) {
		if (n % 2 == 0) {
			n = n / 2;
		}
		else {
			n = (3 * n) + 1;
		}
		steps++;
	}

	cout << steps << endl;
	system("pause");
}