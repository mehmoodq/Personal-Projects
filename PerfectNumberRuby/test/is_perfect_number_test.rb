require 'minitest/autorun'
require 'minitest/pride'
require './src/is_perfect_number'

class PerfectNumberTest < MiniTest::Test

  def test_is_perfect_imperative_1
    assert !is_perfect_number_imperative(1)
  end

  def test_is_perfect_imperative_2
    assert !is_perfect_number_imperative(2)
  end

  def test_is_perfect_imperative_3
    assert !is_perfect_number_imperative(3)
  end

  def test_is_perfect_imperative_6
    assert is_perfect_number_imperative(6)
  end

  def test_is_perfect_imperative_7
    assert !is_perfect_number_imperative(7)
  end

  def test_is_perfect_imperative_27
    assert !is_perfect_number_imperative(27)
  end

  def test_is_perfect_imperative_28
    assert is_perfect_number_imperative(28)
  end

  def test_isperfect_functional_1
    assert !is_perfect_number_functional(1)
  end

  def test_isperfect_functional_2
    assert !is_perfect_number_functional(2)
  end

  def test_isperfect_functional_3
    assert !is_perfect_number_functional(3)
  end

  def test_isperfect_functional_4
    assert !is_perfect_number_functional(4)
  end

  def test_isperfect_functional_6
    assert is_perfect_number_functional(6)
  end

  def test_isperfect_functional_66
    assert !is_perfect_number_functional(66)
  end

  def test_isperfect_functional_28
    assert is_perfect_number_functional(28)
  end
end
