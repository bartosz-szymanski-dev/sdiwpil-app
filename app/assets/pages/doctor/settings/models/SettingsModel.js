import WorkingTimeModel from './WorkingTimeModel';

class SettingsModel {
  constructor(
    {
      email = '',
      password = {
        first: '',
        second: '',
      },
      medicalSpecialty = '',
      workingTime = new WorkingTimeModel(),
    } = {},
  ) {
    this.email = email;
    this.password = password;
    this.medicalSpecialty = medicalSpecialty;
    this.workingTime = workingTime;
  }
}

export default SettingsModel;
