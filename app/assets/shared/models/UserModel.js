class UserModel {
  constructor(
    {
      firstName = '',
      secondName = '',
      lastName = '',
      agreeTerms = false,
      email = '',
      password = '',
      passwordRepeat = '',
    } = {},
  ) {
    this.firstName = firstName;
    this.secondName = secondName;
    this.lastName = lastName;
    this.agreeTerms = agreeTerms;
    this.email = email;
    this.password = password;
    this.passwordRepeat = passwordRepeat;
  }
}

export default UserModel;
