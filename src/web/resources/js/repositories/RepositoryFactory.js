import AuthRepository from "./authRepository";

import nicoComicRepository from "./nicoComicRepository";
import tagRepository from "./TagRepository";
import exclusionRepository from "./exclusionRepository";


const repositories = {
    auth: AuthRepository,
    nicoComic: nicoComicRepository,
    tag: tagRepository,
    exclusion: exclusionRepository,
};

export const RepositoryFactory = {
    get: name => repositories[name]
}
