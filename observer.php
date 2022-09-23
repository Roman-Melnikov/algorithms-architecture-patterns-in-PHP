<?php

class Name
{
    public function __construct(
        private string $firstName,
        private string $lastName
    )
    {
    }
}

class Candidate implements SplObserver
{
    public function __construct(
        private Name   $name,
        private string $mail,
        private int    $experience
    )
    {
    }

    public function update(SplSubject $subject)
    {
        mail(
            $this->mail,
            'New Vacancy',
            $subject->lastJobAdded()->getDescription
        );
    }
}

class Vacancy
{
    public function __construct(
        private string $name,
        private string $description,
        private string $salary
    )
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSalary(): string
    {
        return $this->salary;
    }

    /**
     * @param string $salary
     */
    public function setSalary(string $salary): void
    {
        $this->salary = $salary;
    }

}

interface VacanciesRepository
{
    public function save(Vacancy $vacancy): void;

    public function getById(int $id): Vacancy;

    public function getByName(string $name): array;

    public function delete(Vacancy $vacancy): void;

    public function lastJobAdded(): Vacancy;
}

class SqliteVacanciesRepository implements VacanciesRepository, SplSubject
{
    private PDO $pdo;
    private SplObjectStorage $observers;

    public function __construct()
    {
        $this->pdo = new PDO('path');
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function save(Vacancy $vacancy): void
    {
        echo 'Добавляем новую вакансию в базу';
    }

    public function getById(int $id): Vacancy
    {
        echo 'Возвращаем вакансию с заданным id, если таковой нет , то кидаем исключение';
    }

    public function getByName(string $name): array
    {
        echo 'Возвращаем вакансию по заданному имени, если таковой нет , то кидаем исключение';
    }

    public function delete(Vacancy $vacancy): void
    {
        echo 'Удаление вакансии из базы';
    }

    public function lastJobAdded(): Vacancy
    {
        echo 'Возвращаем последнюю добавленную вакансию';
    }
}

$candidate = new Candidate(
    new Name('Иван', 'Никитин'),
    'user@example.com',
    1
);

$vacanciesRepository = new SqliteVacanciesRepository();

$vacanciesRepository->attach($candidate);

$vacanciesRepository->save(
    new Vacancy(
        'PHP-разработчик',
        'description',
        'по договорённости'
    )
);
$vacanciesRepository->notify();