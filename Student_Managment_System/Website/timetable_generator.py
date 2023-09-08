import random

def get_subject_info(num_sections, num_subjects):
    subjects = []
    for section in range(1, num_sections + 1):
        print(f"--- Section {section} ---")
        for i in range(num_subjects):
            subject = input(f"Enter subject {i+1} for Section {section}: ")
            subjects.append({"section": section, "subject": subject})
    return subjects

def get_teachers_for_subjects(subjects, num_teachers):
    teachers = []
    for subject in subjects:
        print(f"--- {subject['subject']} ---")
        for i in range(num_teachers):
            teacher = input(f"Enter name of faculty {i+1} for {subject['subject']}: ")
            teachers.append({"subject": subject['subject'], "teacher": teacher})
    return teachers

def assign_teachers_to_sections(subjects, teachers):
    # Shuffle the teachers to assign them to sections without overlapping
    random.shuffle(teachers)
    section_teacher_mapping = {section: [] for section in range(1, max(subjects, key=lambda x: x['section'])['section'] + 1)}

    for teacher in teachers:
        for section in section_teacher_mapping:
            if not any(teacher['teacher'] == t for t in section_teacher_mapping[section]):
                section_teacher_mapping[section].append(teacher)
                break

    return section_teacher_mapping

def generate_timetable(days, time_slots, num_sections, subjects, teachers):
    timetable = {day: {time_slot: {section: None for section in range(1, num_sections + 1)} for time_slot in time_slots} for day in days}

    for day in timetable:
        # Reset the section_teacher_mapping for each new day
        section_teacher_mapping = assign_teachers_to_sections(subjects, teachers)

        for time_slot in time_slots:
            if "Break" in time_slot or "Lunch" in time_slot:
                continue

            for section, teacher_list in section_teacher_mapping.items():
                if not teacher_list:
                    break

                if timetable[day][time_slot][section] is None:
                    teacher = teacher_list.pop(0)
                    subject = teacher['subject']
                    timetable[day][time_slot][section] = {"subject": subject, "teacher": teacher['teacher']}

    return timetable

def print_timetable(days, time_slots, timetable):
    for day in days:
        print(f"\n--- {day} ---")
        header = "Time Slot"
        for section in timetable[day][time_slots[0]]:
            header += f"\tSection {section}"
        print(header)

        for time_slot in time_slots:
            if "Break" in time_slot or "Lunch" in time_slot:
                continue

            row = f"{time_slot}"
            for section in timetable[day][time_slot]:
                subject = timetable[day][time_slot][section]["subject"] if timetable[day][time_slot][section] else "None"
                teacher = timetable[day][time_slot][section]["teacher"] if timetable[day][time_slot][section] else "None"
                row += f"\t{subject} - {teacher}"
            print(row)

def main():
    days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
    time_slots = [
        "9.00 am - 9.45 am",
        "9.45 am - 10.30 am",
        "10.30 am - 10.45 am (Break)",
        "10.45 am - 11.30 am",
        "11.30 am - 12.15 pm",
        "12.15 pm - 1.00 pm (Lunch Break)",
        "1.00 pm - 1.45 pm",
        "1.45 pm - 2.30 pm",
        "2.30 pm - 2.45 pm (Break)",
        "2.45 pm - 3.30 pm"
    ]
    num_sections = int(input("Enter the number of sections: "))
    num_subjects = int(input("Enter the number of subjects per section: "))

    subjects = get_subject_info(num_sections, num_subjects)
    num_teachers = int(input("Enter the number of teachers per subject: "))
    teachers = get_teachers_for_subjects(subjects, num_teachers)

    timetable = generate_timetable(days, time_slots, num_sections, subjects, teachers)
    print_timetable(days, time_slots, timetable)


main()