document.getElementById('num_families').addEventListener('input', function () {
    const numFamilies = parseInt(this.value) || 0;
    const familiesSection = document.getElementById('families_section');
    familiesSection.innerHTML = '';

    for (let i = 1; i <= numFamilies; i++) {
        const familyCard = document.createElement('div');
        familyCard.className = 'card mb-4 shadow family-card';

        familyCard.innerHTML = `
            <div class="card-header" role="button" onclick="toggleCollapse('family_body_${i}')">
                <h4>Family ${i}</h4>
                <button type="button" class="btn btn-danger btn-sm float-end delete-btn" onclick="removeCard(this)">X</button>
            </div>
            <div id="family_body_${i}" class="collapse" style="display: none;">
                <div class="card-body" style="width: 100%;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="4PsMember_${i}" name="4PsMember_${i}">
                                <label class="form-check-label" for="4PsMember_${i}">4Ps Member</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="button" class="btn btn-success" onclick="addFamilyMember(${i})">Add Family Member</button>
                            <div id="family_members_${i}"></div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        familiesSection.appendChild(familyCard);
    }
});

function addFamilyMember(familyIndex) {
    const familyMembersDiv = document.getElementById(`family_members_${familyIndex}`);
    const memberCount = familyMembersDiv.children.length + 1; // Count existing members

    const memberCard = document.createElement('div');
    memberCard.className = 'card my-4 shadow p-3 family-member';

    memberCard.innerHTML = `
        <div class="card-header" role="button" id="header_${familyIndex}_${memberCount}" onclick="toggleCollapse('member_body_${familyIndex}_${memberCount}')">
            <h5 class="mb-0">Member ${memberCount}</h5>
            <button type="button" class="btn btn-danger btn-sm float-end delete-btn" onclick="removeCard(this)">X</button>
        </div>
        <div id="member_body_${familyIndex}_${memberCount}" class="collapse" style="display: none;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="role_${familyIndex}_${memberCount}" class="form-label">Role</label>
                        <select class="form-select" id="role_${familyIndex}_${memberCount}" name="role_${familyIndex}_${memberCount}" required>
                            <option value="husband">Husband</option>
                            <option value="wife">Wife</option>
                            <option value="child">Child</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastname_${familyIndex}_${memberCount}" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname_${familyIndex}_${memberCount}" name="lastname_${familyIndex}_${memberCount}" required oninput="updateMemberHeader(${familyIndex}, ${memberCount})">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstname_${familyIndex}_${memberCount}" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname_${familyIndex}_${memberCount}" name="firstname_${familyIndex}_${memberCount}" required oninput="updateMemberHeader(${familyIndex}, ${memberCount})">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="middlename_${familyIndex}_${memberCount}" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middlename_${familyIndex}_${memberCount}" name="middlename_${familyIndex}_${memberCount}" required oninput="updateMemberHeader(${familyIndex}, ${memberCount})">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="date_of_birth_${familyIndex}_${memberCount}" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth_${familyIndex}_${memberCount}" name="date_of_birth_${familyIndex}_${memberCount}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="civil_status_${familyIndex}_${memberCount}" class="form-label">Civil Status</label>
                        <select class="form-select" id="civil_status_${familyIndex}_${memberCount}" name="civil_status_${familyIndex}_${memberCount}" required>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Legally Separated">Legally Separated</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="educational_attainment_${familyIndex}_${memberCount}" class="form-label">Educational Attainment</label>
                        <select class="form-select" id="educational_attainment_${familyIndex}_${memberCount}" name="educational_attainment_${familyIndex}_${memberCount}" required>
                            <option value="Elementary Graduate">Elementary Graduate</option>
                            <option value="Elementary Undergraduate">Elementary Undergraduate</option>
                            <option value="Highschool Graduate">Highschool Graduate</option>
                            <option value="Highschool Undergraduate">Highschool Undergraduate</option>
                            <option value="College Graduate">College Graduate</option>
                            <option value="College Undergraduate">College Undergraduate</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="occupation_${familyIndex}_${memberCount}" class="form-label">Occupation</label>
                        <input type="text" class="form-control" id="occupation_${familyIndex}_${memberCount}" name="occupation_${familyIndex}_${memberCount}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="religion_${familyIndex}_${memberCount}" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion_${familyIndex}_${memberCount}" name="religion_${familyIndex}_${memberCount}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="citizenship_${familyIndex}_${memberCount}" class="form-label">Citizenship</label>
                        <input type="text" class="form-control" id="citizenship_${familyIndex}_${memberCount}" name="citizenship_${familyIndex}_${memberCount}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sex_${familyIndex}_${memberCount}" class="form-label">Sex</label>
                        <select class="form-select" id="sex_${familyIndex}_${memberCount}" name="sex_${familyIndex}_${memberCount}" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone_number_${familyIndex}_${memberCount}" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number_${familyIndex}_${memberCount}" name="phone_number_${familyIndex}_${memberCount}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email_${familyIndex}_${memberCount}" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_${familyIndex}_${memberCount}" name="email_${familyIndex}_${memberCount}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="button" class="btn btn-info" onclick="addSubFamily(${familyIndex}, ${memberCount})">Add Own Family</button>
                        <div id="sub_families_${familyIndex}_${memberCount}"></div>
                    </div>
                </div>
            </div>
        </div>
    `;

    familyMembersDiv.appendChild(memberCard);
}

function addSubFamily(familyIndex, memberIndex) {
    const subFamiliesDiv = document.getElementById(`sub_families_${familyIndex}_${memberIndex}`);
    const subFamilyCount = subFamiliesDiv.children.length + 1;

    const subFamilyCard = document.createElement('div');
    subFamilyCard.className = 'card my-4 shadow p-3 sub-family';

    subFamilyCard.innerHTML = `
        <div class="card-header" role="button" onclick="toggleCollapse('sub_family_body_${familyIndex}_${memberIndex}_${subFamilyCount}')">
            <h5 class="mb-0">Sub-Family ${subFamilyCount}</h5>
            <button type="button" class="btn btn-danger btn-sm float-end delete-btn" onclick="removeCard(this)">X</button>
        </div>
        <div id="sub_family_body_${familyIndex}_${memberIndex}_${subFamilyCount}" class="collapse" style="display: none;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="4PsMember_${familyIndex}_${memberIndex}_${subFamilyCount}" name="4PsMember_${familyIndex}_${memberIndex}_${subFamilyCount}">
                            <label class="form-check-label" for="4PsMember_${familyIndex}_${memberIndex}_${subFamilyCount}">4Ps Member</label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="button" class="btn btn-success" onclick="addSubFamilyMember(${familyIndex}, ${memberIndex}, ${subFamilyCount})">Add Sub-Family Member</button>
                        <div id="sub_family_members_${familyIndex}_${memberIndex}_${subFamilyCount}"></div>
                    </div>
                </div>
            </div>
        </div>`;


    subFamiliesDiv.appendChild(subFamilyCard);
}

function addSubFamilyMember(familyIndex, memberIndex, subFamilyIndex) {
    const subFamilyMembersDiv = document.getElementById(`sub_family_members_${familyIndex}_${memberIndex}_${subFamilyIndex}`);
    const memberCount = subFamilyMembersDiv.children.length + 1;

    const memberCard = document.createElement('div');
    memberCard.className = 'card my-4 shadow p-3 sub-family-member';

    memberCard.innerHTML = `
        <div class="card-header" role="button" onclick="toggleCollapse('sub_member_body_${familyIndex}_${memberIndex}_${subFamilyIndex}_${memberCount}')">
            <h5 class="mb-0">Sub-Family Member ${memberCount}</h5>
            <button type="button" class="btn btn-danger btn-sm float-end delete-btn" onclick="removeCard(this)">X</button>
        </div>
        <div id="sub_member_body_${familyIndex}_${memberIndex}_${subFamilyIndex}_${memberCount}" class="collapse" style="display: none;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sub_role_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Role</label>
                        <select class="form-select" id="sub_role_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_role_${familyIndex}_${subFamilyIndex}_${memberCount}" required>
                            <option value="husband">Husband</option>
                            <option value="wife">Wife</option>
                            <option value="child">Child</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_lastname_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="sub_lastname_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_lastname_${familyIndex}_${subFamilyIndex}_${memberCount}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_firstname_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="sub_firstname_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_firstname_${familyIndex}_${subFamilyIndex}_${memberCount}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_middlename_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="sub_middlename_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_middlename_${familyIndex}_${subFamilyIndex}_${memberCount}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_date_of_birth_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="sub_date_of_birth_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_date_of_birth_${familyIndex}_${subFamilyIndex}_${memberCount}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_civil_status_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Civil Status</label>
                        <select class="form-select" id="sub_civil_status_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_civil_status_${familyIndex}_${subFamilyIndex}_${memberCount}" required>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Legally Separated">Legally Separated</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_educational_attainment_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Educational Attainment</label>
                        <select class="form-select" id="sub_educational_attainment_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_educational_attainment_${familyIndex}_${subFamilyIndex}_${memberCount}" required>
                            <option value="Elementary Graduate">Elementary Graduate</option>
                            <option value="Elementary Undergraduate">Elementary Undergraduate</option>
                            <option value="Highschool Graduate">Highschool Graduate</option>
                            <option value="Highschool Undergraduate">Highschool Undergraduate</option>
                            <option value="College Graduate">College Graduate</option>
                            <option value="College Undergraduate">College Undergraduate</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_occupation_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Occupation</label>
                        <input type="text" class="form-control" id="sub_occupation_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_occupation_${familyIndex}_${subFamilyIndex}_${memberCount}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_religion_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="sub_religion_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_religion_${familyIndex}_${subFamilyIndex}_${memberCount}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_citizenship_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Citizenship</label>
                        <input type="text" class="form-control" id="sub_citizenship_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_citizenship_${familyIndex}_${subFamilyIndex}_${memberCount}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_sex_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Sex</label>
                        <select class="form-select" id="sub_sex_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_sex_${familyIndex}_${subFamilyIndex}_${memberCount}" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_phone_number_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="sub_phone_number_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_phone_number_${familyIndex}_${subFamilyIndex}_${memberCount}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sub_email_${familyIndex}_${subFamilyIndex}_${memberCount}" class="form-label">Email</label>
                        <input type="email" class="form-control" id="sub_email_${familyIndex}_${subFamilyIndex}_${memberCount}" name="sub_email_${familyIndex}_${subFamilyIndex}_${memberCount}">
                    </div>
                </div>
            </div>
        </div>
    `;

    subFamilyMembersDiv.appendChild(memberCard);
}

function removeCard(button) {
    const card = button.closest('.card');
    card.remove();
}

function toggleCollapse(id) {
    const content = document.getElementById(id);
    const isCollapsed = content.style.display === 'none';

    content.style.display = isCollapsed ? 'block' : 'none';
}

function updateMemberHeader(familyIndex, memberCount) {
    const firstName = document.getElementById(`firstname_${familyIndex}_${memberCount}`).value;
    const middleName = document.getElementById(`middlename_${familyIndex}_${memberCount}`).value;
    const lastName = document.getElementById(`lastname_${familyIndex}_${memberCount}`).value;

    // Get the middle initial
    const middleInitial = middleName ? middleName.charAt(0) + '.' : '';

    const header = document.getElementById(`header_${familyIndex}_${memberCount}`);
    header.querySelector('h5').textContent = `${firstName} ${middleInitial} ${lastName}`.trim() || `Member ${memberCount}`;
}

