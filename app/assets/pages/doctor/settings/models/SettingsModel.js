class SettingsModel {
  constructor(
    {
      email = '',
      password = {
        first: '',
        second: '',
      },
      medicalSpecialty = '',
      workingTime = {},
    } = {},
  ) {
    this.email = email;
    this.password = password;
    this.medicalSpecialty = medicalSpecialty;
    this.workingTime = workingTime;
  }
}

export default SettingsModel;
