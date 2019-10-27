def is_perfect_number_imperative(number)
  sum_of_factors = 0

  for i in 1..number
    sum_of_factors += i if number % i == 0
  end

  sum_of_factors == number * 2
end

def is_perfect_number_functional(number)
  (1..number).select { |i| number % i == 0 }.sum == number * 2
end
