class SettingsModel {
  constructor(
    {
      email = '',
      password = '',
      passwordRepeat = '',
      medicalSpecialty = '',
      workingTimeSettings = '', // TODO: make an object of that
    } = {},
  ) {
    this.email = email;
    this.password = password;
    this.passwordRepeat = passwordRepeat;
    this.medicalSpecialty = medicalSpecialty;
    this.workingTimeSettings = workingTimeSettings;
  }
}

export default SettingsModel;
